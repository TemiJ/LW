<?php
namespace CLW\Bundle\CoverLetterBundle\CoverLetterWriter;
class CoverLetterWriter {

  public function selectParagraph ($section) {

        // Select a random number based on
        // the range of how many options available
        // for letter section.
        $n = count($section);
        $randomNumber = rand (0, ($n - 1));

        $paragraph = $section[$randomNumber];

        return $paragraph;
    }


}
