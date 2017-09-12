<?php

namespace ZAToday\Repository;

use ZAToday\Repository\Constracts\CriteriaInterface;

class CriteriaRepository implements CriteriaInterface{

    /**
     * @var Collection
     */
    protected $criteria;

    /**
     * @var bool
     */
    protected $skipCriteria = false;

    /**
     * @return $this
     */
    public function resetScope() {
        $this->skipCriteria(false);
        return $this;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function skipCriteria($status = true){
        $this->skipCriteria = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCriteria() {
        return $this->criteria;
    }

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function getByCriteria(Criteria $criteria) {
        $this->model = $criteria->apply($this->model, $this);
        return $this;
    }

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function pushCriteria(Criteria $criteria) {
        $this->criteria->push($criteria);
        return $this;
    }

    /**
     * @return $this
     */
    public function applyCriteria() {
        if($this->skipCriteria === true){
            return $this;
        }

        foreach($this->getCriteria() as $criteria) {
            if($criteria instanceof Criteria){
                $this->model = $criteria->apply($this->model, $this);
            }
        }

        return $this;
    }
}
