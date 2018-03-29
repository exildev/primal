<?php
	echo "Dowinloading files...\n";
	$repository = "https://github.com/exildev/primal/archive/master.zip";
	$repository_filename = "repository.zip";
	$repository_content = file_get_contents($repository);

	$file = fopen($repository_filename, "wb");
    fwrite($file, $repository_content);
    fclose($file);

	echo "Unziping files\n";
    $repository_zipped = new ZipArchive();
	$repository_succeful = $repository_zipped->open($repository_filename);
	if ($repository_succeful === TRUE) {
	    $repository_zipped ->extractTo("repository/");
	    $repository_zipped ->close();
	    // Do something else on success
	} else {
	    echo "Sorry some not work fine :'(";
	}