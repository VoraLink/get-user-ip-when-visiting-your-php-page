        <?php
function getUserIP() {
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}

$user_ip = getUserIP();

$file_path = __DIR__ . 'ENTER-YOUR-FILE-PATH-AND-TXT-FOR-SAVE-YOUR-VICTIMS';

if (!file_exists(__DIR__ . 'ENTER-YOUR-FILE-PATH')) {
    mkdir(__DIR__ . 'ENTER-YOUR-FILE-PATH', 0777, true);
}

$fp = fopen($file_path, 'a');
fwrite($fp, $user_ip . PHP_EOL);
fclose($fp);

$line = date('Y-m-d H:i:s') . " - $user_ip";
file_put_contents(__DIR__ . 'ENTER-YOUR-FILE-PATH/visitors.log', $line . PHP_EOL, FILE_APPEND);
        ?>
