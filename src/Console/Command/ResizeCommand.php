<?php

namespace Console\Command;

use \PDO;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ResizeCommand extends Command
{
    protected $config = null;

    protected function configure()
    {
        $this
            ->setName('resize')
            ->setDescription('resize photo')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // include configuration data
        $this->config = include('config.php');
        // connect to database
        $dsn = $this->config['db']['dsn'];
        $db = new PDO($dsn, $this->config['db']['username'], $this->config['db']['password']);
        $db->exec("set names utf8");
        if (!$db)
        {
            $output->writeln('Error connecting to database');
            exit();
        }

        // find the earliest image with new status to be resized
        $query = $db->query('SELECT * FROM `resized` WHERE `status`=1 ORDER BY `id` ASC');
        $image = $query->fetch(PDO::FETCH_ASSOC);

        if (!$image)
        {
            $output->writeln('All images resized');
            exit();
        }

        // set status 'in_progres'
        $sql = 'UPDATE `resized` SET `status` = 2 WHERE `id` = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $image['id'], PDO::PARAM_INT);
        $result->execute();

        // get the image original
        $sql = 'SELECT * FROM `album/images` WHERE `id` = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $image['photo_id'], PDO::PARAM_INT);
        $result->execute();
        $imageOriginal = $result->fetch(PDO::FETCH_ASSOC);

        // prepare path for resized image
        $src = 'application/data/images/resized/';
        if (!file_exists($this->config['root'].$src.$imageOriginal['album']))
        {
            mkdir($this->config['root'].$src.'/'.$imageOriginal['album'], 0700);
        }
        $src .= $imageOriginal['album'].'/'.$image['size'].'_'.$imageOriginal['id'].'.jpg';
        $path = $this->config['root'].$src;

        // resize image
        $imageResource = imagecreatefromstring($imageOriginal['image']);
        if (!$imageResource)
        {
            $output->writeln('Error reading image data');
            exit();
        }
        $imageScale = imagescale($imageResource, (int) $image['size']);
        if (imagejpeg($imageScale, $path) === false)
        {
            // set status 'error'
            $sql = 'UPDATE `resized` SET `status` = 4 WHERE `id` = :id';
            $result = $db->prepare($sql);
            $result->bindParam(':id', $image['id'], PDO::PARAM_INT);
            $result->execute();
            $output->writeln('Resize failed');
            exit();
        }
        imagedestroy($imageResource);
        imagedestroy($imageScale);

        // write src of resized image
        $sql = 'UPDATE `resized` SET `src` = :src WHERE `id` = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':src', $src, PDO::PARAM_STR);
        $result->bindParam(':id', $image['id'], PDO::PARAM_INT);
        $result->execute();

        //set status 'complete'
        $sql = 'UPDATE `resized` SET `status` = 3 WHERE `id` = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $image['id'], PDO::PARAM_INT);
        $result->execute();

        $output->writeln($imageOriginal['id']);
    }
}
