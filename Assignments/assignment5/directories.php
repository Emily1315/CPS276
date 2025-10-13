<?php
class Directories {
    public function create($dirName, $content) {
        $basePath = "directories";
        $targetDir = "$basePath/$dirName";
        $filePath = "$targetDir/readme.txt";

        // Check if directory already exists
        if (is_dir($targetDir)) {
            return [
                "success" => false,
                "message" => "A directory already exists with that name."
            ];
        }

        // Attempt to create directory
        if (!mkdir($targetDir, 0777, true)) {
            return [
                "success" => false,
                "message" => "Error: Directory could not be created."
            ];
        }

        // Attempt to create file
        $file = fopen($filePath, "w");
        if (!$file) {
            return [
                "success" => false,
                "message" => "Error: File could not be created."
            ];
        }

        fwrite($file, $content);
        fclose($file);

        return [
            "success" => true,
            "message" => "Directory and file created successfully."
        ];
    }
}
?>
