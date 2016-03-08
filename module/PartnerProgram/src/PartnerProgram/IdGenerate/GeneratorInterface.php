<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 06.03.16
 * Time: 18:42
 */

namespace PartnerProgram\IdGenerate;


interface GeneratorInterface
{
    /**
     * @return string
     */
    public function generate();
}