<?php
namespace Ca\Db;

/**
 * @author Mick Mifsud
 * @created 2019-11-05
 * @link http://tropotek.com.au/
 * @license Copyright 2019 Tropotek
 */
class Item extends \Tk\Db\Map\Model implements \Tk\ValidInterface
{
    use Traits\AssessmentTrait;
    use Traits\ScaleTrait;
    use Traits\DomainTrait;

    /**
     * @var int
     */
    public $id = 0;

    /**
     * @var string
     */
    public $uid = '';

    /**
     * @var int
     */
    public $assessmentId = 0;

    /**
     * @var int
     */
    public $scaleId = 0;

    /**
     * @var int
     */
    public $domainId = 0;

    /**
     * @var string
     */
    public $name = '';

    /**
     * @var string
     */
    public $description = '';

    /**
     * @var bool
     */
    public $gradable = false;

    /**
     * @var bool
     */
    public $required = false;

    /**
     * @var int
     */
    public $orderBy = 0;

    /**
     * @var \DateTime
     */
    public $modified = null;

    /**
     * @var \DateTime
     */
    public $created = null;

    /**
     * @var null|\Tk\Db\Map\ArrayObject|Competency[]
     */
    private $competencyList = null;


    /**
     * Item
     */
    public function __construct()
    {
        $this->modified = new \DateTime();
        $this->created = new \DateTime();

    }
    
    /**
     * @param string $uid
     * @return Item
     */
    public function setUid($uid) : Item
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * return string
     */
    public function getUid() : string
    {
        return $this->uid;
    }

    /**
     * @param string $name
     * @return Item
     */
    public function setName($name) : Item
    {
        $this->name = $name;
        return $this;
    }

    /**
     * return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $description
     * @return Item
     */
    public function setDescription($description) : Item
    {
        $this->description = $description;
        return $this;
    }

    /**
     * return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * @param bool $gradable
     * @return Item
     */
    public function setGradable($gradable) : Item
    {
        $this->gradable = $gradable;
        return $this;
    }

    /**
     * return bool
     */
    public function isGradable() : bool
    {
        return $this->gradable;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     * @return Item
     */
    public function setRequired(bool $required): Item
    {
        $this->required = $required;
        return $this;
    }

    /**
     * @param int $orderBy
     * @return Item
     */
    public function setOrderBy($orderBy) : Item
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * return int
     */
    public function getOrderBy() : int
    {
        return $this->orderBy;
    }

    /**
     * @param \DateTime $modified
     * @return Item
     */
    public function setModified($modified) : Item
    {
        $this->modified = $modified;
        return $this;
    }

    /**
     * return \DateTime
     */
    public function getModified() : \DateTime
    {
        return $this->modified;
    }

    /**
     * @param \DateTime $created
     * @return Item
     */
    public function setCreated($created) : Item
    {
        $this->created = $created;
        return $this;
    }

    /**
     * return \DateTime
     */
    public function getCreated() : \DateTime
    {
        return $this->created;
    }

    /**
     * @return Competency[]|\Tk\Db\Map\ArrayObject|null
     * @throws \Exception
     */
    public function getCompetencyList()
    {
        if (!$this->competencyList) {
            $this->competencyList = CompetencyMap::create()->findFiltered(array('itemId' => $this->getId()));
        }
        return $this->competencyList;
    }
    
    /**
     * @return array
     */
    public function validate()
    {
        $errors = array();

        $errors = $this->validateAssessmentId($errors);
        $errors = $this->validateScaleId($errors);
        //$errors = $this->validateDomainId($errors);

        // TODO: Check that there is > 1 competency for this to be null
//        if (!$this->name) {
//            $errors['name'] = 'Invalid value: name';
//        }

        return $errors;
    }

}