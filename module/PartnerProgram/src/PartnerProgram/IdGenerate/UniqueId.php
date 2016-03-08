<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 06.03.16
 * Time: 18:43
 */

namespace PartnerProgram\IdGenerate;


class UniqueId implements GeneratorInterface
{
    /**
     * @return string
     */
    public function generate()
    {
        return uniqid();
    }
}