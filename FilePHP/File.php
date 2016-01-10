<?php
/* 
 * Copyright 2016 Dominic Masters <dominic@domsplace.com>.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

if(!class_exists('ArrayList')) throw new Exception('The File class requires the ArrayList class to be imported first.');
if(!function_exists('str_ends_with')) {
    /**
     * Returns true if $needle is found at the end of the string $haystack
     * 
     * @param string $haystack
     * @param string $needle
     * @return bool
     */
    function str_ends_with($haystack, $needle) {
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
    }
}

define('PARENT_DIRECTORY', '..');

class File {
    public static function getDirectorySeparator() {return DIRECTORY_SEPARATOR;}
    
    //Instance
    private $path;
    
    public function __construct($path, $parentdir = null) {
        $this->path = '';
        if($parentdir !== null && $parentdir instanceof File) $this->path .= $parentdir->getPath() . File::getDirectorySeparator();
        $this->path .= $path;
    }
    
    public function isFile() {return is_file($this->path);}
    public function isDirectory() {return is_dir($this->path);}
    
    public function exists() {return file_exists($this->path);}
    
    public function getPath() {return $this->path;}
    public function getName() {return basename($this->path);}
    public function getDirectoryName() {return dirname($this->path);}
    
    public function getFileContents() {return file_get_contents($this->path);}
    
    /**
     * 
     * @return File
     */
    public function getAbsoluteDirectory() {return new File(realpath($this->path));}
    
    public function getDirectoryContents($filter=null, $directories_only=false, $files_only=false) {
        if(!$this->isDirectory()) throw new Exception('Not a directory.');
        $list = new ArrayList('File');
        
        foreach(scandir($this->path) as $file) {
            if($file === '.' || $file === '..') continue;
            if($filter !== null) if(!str_ends_with($file, $filter)) continue;
            $f = new File($file, $this);
            if($directories_only && !$f->isDirectory()) continue;
            if($files_only && !$f->isFile()) continue;
            $list->add($f);
        }
        
        return $list;
    }
    
    /**
     * 
     * @return File
     */
    public function getParent() {
        return new File(PARENT_DIRECTORY , $this);
    }
}
