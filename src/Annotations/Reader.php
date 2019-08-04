<?php

namespace markuszeller\Annotations;

class Reader
{
    private $data;
    private $annotations;
    private $comments;

    /**
     * Loads data from a string
     *
     * @param $string
     */
    public function loadFromString($string): void
    {
        $this->data = $string;
    }

    /**
     * Loads data from a file.
     * When the file could not be opened, returns false.
     * Take care of error handling by yourself.
     *
     * @param $filename
     * @return bool
     */
    public function loadFromFile($filename): bool
    {
        $this->data = file_get_contents($filename);
        if($this->data === false) $this->data = null;

        return $this->data ?? false;
    }

    /**
     * Gets all the annotations by an associative array
     *
     * @return array
     */
    public function getAnnotations(): array
    {
        if ($this->annotations) return $this->annotations;

        $comments = $this->getComments();
        foreach ($comments as $comment) {
            $annotations = [];
            preg_match_all('/^.*@(.*?)\s+([^@]*)$/m', $comment, $annotations);
            for ($i = 0, $len = count($annotations[1]); $i < $len; $i++) {
                $this->annotations[(string)$annotations[1][$i]] = rtrim($annotations[2][$i]);
            }
        }

        return $this->annotations;
    }

    /**
     * Get comment sections to parse annotations from
     *
     * @return array
     */
    private function getComments(): array
    {
        if ($this->comments) return $this->comments;

        $comments = [];
        preg_match_all('|/\*\*(.*?)\*/|s', $this->data, $comments);
        $this->comments = $comments[1];

        return $this->comments;
    }

    /**
     * Returns value of a given annotation
     *
     * @param string $annotation
     * @return string
     */
    public function getAnnotation(string $annotation): string
    {
        if (!$this->annotations) $this->getAnnotations();
        if (!isset($this->annotations[$annotation])) return '';

        return $this->annotations[$annotation];
    }
}
