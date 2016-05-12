<?php

namespace Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ResizeCommand extends Command
{
    private $config;
    protected function configure()
    {
        $this
            ->setName('resize')
            ->setDescription('resize photo')
        ;
        $this->config = include('config.php');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // get image to resize
        if(!$this->getResized())
        {
            $output->writeln('Nothing to resize');
            exit();
        }

        $image = json_decode($this->getResized(), TRUE);
        if ($image === NULL)
        {
            $output->writeln('Resize failed');
            exit();
        }

        // set status 'in_progres'
        $this->putResized(array('status' => 'in_progress'), $image);

        // find the image itself and get row image data
        $imageOriginal = json_decode($this->getAlbumImages($image['photo_id']), TRUE);
        if ($imageOriginal === NULL)
        {
            $output->writeln('Resize failed');
            exit();
        }
        $imageOriginal['image'] = explode(',', $imageOriginal['image'], 2)[1];
        $imageOriginal['image'] = stripslashes(base64_decode($imageOriginal['image']));



        // prepare path for resized image
        $src = 'application/data/images/resized/';
        if (!file_exists($src.'/'.$imageOriginal['album']))
        {
            mkdir($this->config['root'].$src.'/'.$imageOriginal['album'], 0700);
        }
        $src .= $imageOriginal['album'].'/'.$image['size'].'_'.$imageOriginal['id'].'.jpg';

        // resize image
        if (!$this->resize($imageOriginal, $image, $this->config['root'].$src))
        {
            // set status 'error'
            $this->putResized(array('status' => 'error'), $image);
            exit();
        }

        // write src of resized image
        $this->putResized(array('src' => $src), $image);

        //set status 'complete'
        $this->putResized(array('status' => 'complete'), $image);

        $output->writeln('Resize successful for image '.$imageOriginal['id']);
    }

    public function resize($imageOriginal, $imageResized, $src)
    {
        $imageResource = imagecreatefromstring($imageOriginal['image']);
        $imageScale = imagescale($imageResource, (int) $imageResized['size'],(int) $imageResized['size']);
        if (imagejpeg($imageScale, $src) === false)
        {
            return false;
        }
        imagedestroy($imageResource);
        imagedestroy($imageScale);
        return true;
    }

    public function getResized()
    {
        $curl = curl_init($this->config['base_url'].'resized?status=1');

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Send the request
        $response = curl_exec($curl);
        // Free up the resources $curl is using
        curl_close($curl);

        return $response;
    }

    public function putResized($data, $image)
    {
        $data['size'] = $image['size'];
        $data_string = http_build_query($data);

        $curl = curl_init($this->config['base_url'].'resized/'.$image['photo_id']);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");

        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/x-www-form-urlencoded',
                'Content-Length: ' . strlen($data_string))
        );

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        // Send the request
        $response = curl_exec($curl);

        // Free up the resources $curl is using
        curl_close($curl);

        return $response;
    }

    public function getAlbumImages($photo_id)
    {
        $curl = curl_init($this->config['base_url'].'album/images/'.$photo_id);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Send the request
        $response = curl_exec($curl);

        // Free up the resources $curl is using
        curl_close($curl);

        return $response;
    }
}
