<?php
	echo "Dowinloading files...\n";

	$app_name = isset($argv[1])?$argv[1]:'app';

	$repository = "https://github.com/luismoralesp/primal-starter/archive/master.zip";
	$repository_filename = "repository.zip";
	$repository_temp_location = "repository/";
	$repository_folder = "primal-starter-master";

	$repository_content = file_get_contents($repository);
	$file = fopen($repository_filename, "wb");
    fwrite($file, $repository_content);
    fclose($file);

	echo "Unziping files\n";
	
    $repository_zipped = new ZipArchive();
	$repository_succeful = $repository_zipped->open($repository_filename);
	if ($repository_succeful === TRUE) {
	    $repository_zipped ->extractTo($repository_temp_location);
	    $repository_zipped ->close();
	    echo "Coping...";
	    xcopy("$repository_temp_location/$repository_folder", "./" . $app_name);
	    delete_files($repository_temp_location);
	    // Do something else on success
	} else {
	    echo "Sorry, some not work fine :'(";
	}


	/**
	 * Copy a file, or recursively copy a folder and its contents
	 * @author      Aidan Lister <aidan@php.net>
	 * @version     1.0.1
	 * @link        http://aidanlister.com/2004/04/recursively-copying-directories-in-php/
	 * @param       string   $source    Source path
	 * @param       string   $dest      Destination path
	 * @param       int      $permissions New folder creation permissions
	 * @return      bool     Returns true on success, false on failure
	 */
	function xcopy($source, $dest, $permissions = 0755)
	{
	    // Check for symlinks
	    if (is_link($source)) {
	        return symlink(readlink($source), $dest);
	    }

	    // Simple copy for a file
	    if (is_file($source)) {
	        return copy($source, $dest);
	    }

		    // Make destination directory
	    if (!is_dir($dest)) {
	        mkdir($dest, $permissions);
	    }

	    // Loop through the folder
	    $dir = dir($source);
	    while (false !== $entry = $dir->read()) {
	        // Skip pointers
	        if ($entry == '.' || $entry == '..') {
	            continue;
	        }

	        // Deep copy directories
	        xcopy("$source/$entry", "$dest/$entry", $permissions);
	    }

	    // Clean up
	    $dir->close();
	    return true;
	}

	/* 
	 * php delete function that deals with directories recursively
	 */
	function delete_files($target) {
	    if(is_dir($target)){

	        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
	        foreach( $files as $file ){
	            delete_files( $file );      
	        }
	        if (is_file( $target . '.gitkeep')){
	        	unlink( $target . '.gitkeep' );
	    	}
	        rmdir( $target );
	    } elseif(is_file($target)) {
	        unlink( $target );
	    }
	}