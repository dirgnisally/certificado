# certificado

Instalar php Requerimientos:

PHP requiere al menos Windows 2008/Vista. Ya sea 32 bits o 64 bits (AKA X86 o X64. PHP no se ejecuta en Windows RT/WOA/ARM). A partir de PHP 7.2.0 Windows 2008 y Vista ya no son soportados.
PHP requiere Visual C runtime (CRT). Muchas aplicaciones lo requieren por lo que ya esté instalado. 

Instalacion Manual php
Descargar el fichero .ZIP o la compilación de PHP desde http://windows.php.net/downloads/

Instalar Apache 2.x con PHP en sistemas Microsoft Windows. 
  Download de la url https://httpd.apache.org/download.cgi
  Configurar el archivo httpd.conf ubicado en la carpeta conf
  añadir esta linea
  LoadModule php4_module "C:\server\php\php8apache2_4.dll"
  AddHandler application/x-httpd-php .php
  PHPIniDir "C:\server\php"
  
 Añadir las librerias de php en php.ini
 extension=php_openssl.dll
 
 
 
