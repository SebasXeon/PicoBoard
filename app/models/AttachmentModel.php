<?php
// Attachment model

class Attachment {
    private $DB;

    public $id;
    public $filename;
    public $original_filename;
    public $mime_type;
    public $file_size;
    public $created_at;
    public $updated_at;

    public function __construct($id, $filename, $original_filename, $mime_type, $file_size, $created_at, $updated_at) {
        $this->id = $id;
        $this->filename = $filename;
        $this->original_filename = $original_filename;
        $this->mime_type = $mime_type;
        $this->file_size = $file_size;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
}