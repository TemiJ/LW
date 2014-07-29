<?php
namespace CLW\Bundle\CoverLetterBundle\CoverLetterWriter;

class SectionSelector {

 public function introduction($type) {
        switch ($type) {
            case 'ns':
                $intro[] = 'Attached is my CV containing pertinent information regarding
                my qualifications. I am confident that my knowledge and abilities
                can be used to enhance [company name session].';

                $intro[] = 'A work history can only tell the bare back of my story which
                can be gained from the attached CV. Therefore, this letters main
                purpose is for you to get know me while simultaneously
                providing you with good reason why you should consider me for
                the position of [position name].';
                break;

        }

        return $intro;
    }

}