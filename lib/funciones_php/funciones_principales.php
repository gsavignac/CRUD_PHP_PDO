<?php
function generar_codigo($entropy = null)
{
    $s=uniqid("",$entropy);
    $num= hexdec(str_replace(".","",(string)$s));
    $index = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $base= strlen($index);
    $out = '';
        for($t = floor(log10($num) / log10($base)); $t >= 0; $t--) {
            $a = floor($num / pow($base,$t));
            $out = $out.substr($index,$a,1);
            $num = $num-($a*pow($base,$t));
        }
    return $out;
}
function mostrar_modulos(){
    $ruta = "modules/";
    $dir = opendir($ruta);
    while(($elementos = readdir($dir))!==false)
    {
        if($elementos!=="." && $elementos!==".." && is_dir($ruta.$elementos) && $elementos!='login')
        {
            echo '<li class=""><a href="javascript:void(0)" onclick="cargar_contenido(\''.$elementos.'\');">' . strtoupper($elementos) . "</a></li>";
        }
    }
    closedir($dir);
}
?>