# File
Java Like Files for PHP

## What is FilePHP?
The idea came when trying to work with files in a manner that is easily controlled and replicated, less of the "Use strings and point to file locations" and more of the Java approach "Use Objects that refer to a virtual hard drive location".

## Why use it?
This is a matter of preference above anything else, FilePHP is unlikely to offer you anything that normal PHP functions can't already offer you, but FilePHP offers them all (or at least will when/if I get around to completing the class) in a single object!

Take for example the idea of easily traversing files, especialy between the OS's
```
$f = new File('somedocument.txt');
$f = $f->getParent();
echo $f->getName();//Echo's "Some Folder"
$f = new File('anotherFile.txt', $f);
echo $f->getFileContents();//echo's the contents of the file "anotherFile.txt" inside the folder "Some Folder"
```

## Sounds like my cuppa tea! How do I get started
Well, seeing as this class is still in very very early stages of development it will have to be a matter of "learn as you go" unfortunately.

I will be adding to this class a lot over the next while as I develop a website that uses a lot of files.
