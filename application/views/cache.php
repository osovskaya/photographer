<html>
<head>
    <title>Memcached data</title>
    <style>
        div
        {
            width: 1000px;
            padding: 25px;
            margin: 25px;
        }

        table
        {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td
        {
            border: 1px solid gray;
            border-spacing: 2px;
        }
    </style>
</head>
<body>
<section>
    <div>
        <h3>Memcached viewer</h3>
        <table>
            <thead>
                <tr>
                    <th>key</th>
                    <th>created at</th>
                    <th>expires at</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cacheData as $key => $value):?>
                <tr>
                    <td><?php echo $key;?></td>
                    s<td><?php echo date('r', $value['created']);?></td>
                    <td><?php echo date('r', $value['expires']);?></td>
                    <td><a href="http://mysite.com/memcached/<?php echo $key;?>">delete</a></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</section>
</body>
</html>