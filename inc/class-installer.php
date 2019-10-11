<?php 

namespace Skift\Header_Footer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class Installer extends LibraryInstaller {

    public function getInstallPath(PackageInterface $package) {   
        
    }

    public function supports($packageType) {
        return $packageType === 'skift-themepart';
    }
}