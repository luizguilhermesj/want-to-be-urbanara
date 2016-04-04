<?php

class CashMachine
{
    private $availableNotes = [
        100,
        50,
        20,
        10,
    ];

    public function __construct()
    {
        rsort($this->availableNotes);
    }

    public function withdraw($requestedValue, $notes = null)
    {
        if (is_null($requestedValue)) {
            return [];
        }

        $notes = (is_null($notes)) ? $this->availableNotes : $notes;
        $this->validateArgs($requestedValue, $notes);

        if ($requestedValue == $notes[0]){
            return [$notes[0]];
        }

        if ($requestedValue > $notes[0]) {
            return array_merge([$notes[0]], $this->withdraw($requestedValue - $notes[0], $notes));
        }

        array_shift($notes);

        return $this->withdraw($requestedValue, $notes);
    }

    private function validateArgs($requestedValue, $notes)
    {
        if ($requestedValue < 0) {
            throw new InvalidArgumentException;
        }

        if ($requestedValue < $notes[0] && !isset($notes[1])){
            throw new NoteUnavailableException();
        }
    }
}
