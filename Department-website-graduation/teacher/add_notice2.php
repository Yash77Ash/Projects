<?php
session_start();

if (isset($_FILES['file'])) {
	$files = $_FILES['file'];
	$_SESSION['files'] = [];

	foreach ($files['name'] as $key => $name) {
		if ($files['error'][$key] == 0) {
			$extension = pathinfo($name, PATHINFO_EXTENSION);
			$allowed = ['pdf','txt','docx','xml'];

			if (in_array(strtolower($extension), $allowed)) {
				$filename = uniqid('file_', true) . '.' . $extension;
				$destination = 'Notices/' . $filename;

				if (move_uploaded_file($files['tmp_name'][$key], $destination)) {
					$_SESSION['files'][] = [
						'name' => $name,
						'type' => $files['type'][$key],
						'size' => $files['size'][$key],
						'path' => $destination
					];
				} else {
					header('Location: add_notice.php?error');
					exit();
				}
			} else {
				header('Location:add_notice.php?error');
				exit();
			}
		} else {
			header('Location:add_notice.php?error');
			exit();
		}
	}

	header('Location: add_notice.php?success');
	exit();
}
