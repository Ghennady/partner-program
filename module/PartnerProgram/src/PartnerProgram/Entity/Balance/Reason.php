<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 06.03.16
 * Time: 11:59
 */

namespace PartnerProgram\Entity\Balance;

use Doctrine\ORM\Mapping as Orm;

/**
 * @Orm\Embeddable
 */
class Reason
{
    /** снятие */
    const WITHDRAWAL = 'withdrawal';

    /** пополнение */
    const REFILL = 'refill';

    /** подарок */
    const GIFT = 'gift';
    
    /** комиссия */
    const COMMISSION = 'commission';

    /**
     * @var string
     *
     * @Orm\Column(name="reason", type="string")
     */
    private $reason;

    /**
     * Reason constructor.
     * @param string $reason
     */
    public function __construct($reason)
    {
        $this->reason = $reason;
    }

    /**
     * @return bool
     */
    public function isRefill()
    {
        return $this->getValue() === self::REFILL;
    }

    /**
     * @return bool
     */
    public function isWithdrawal()
    {
        return $this->getValue() === self::WITHDRAWAL;
    }

    /**
     * @return bool
     */
    public function isCommission()
    {
        return $this->getValue() === self::COMMISSION;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->reason;
    }
}