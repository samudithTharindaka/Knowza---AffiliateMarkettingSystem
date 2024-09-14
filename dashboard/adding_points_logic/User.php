<?php

class User
{
    private $user_id, $name, $higher_id, $left_points, $right_points, $points_paid, $team, $transaction_count;

    /**
     * @param $user_id
     * @param $name
     * @param $higher_id
     * @param $left_points
     * @param $right_points
     * @param $points_paid
     * @param $team
     * @param $transaction_count
     */
    public function __construct($user_id, $name, $higher_id, $left_points, $right_points, $points_paid, $team, $transaction_count)
    {
        $this->user_id = $user_id;
        $this->name = $name;
        $this->higher_id = $higher_id;
        $this->left_points = $left_points;
        $this->right_points = $right_points;
        $this->points_paid = $points_paid;
        $this->team = $team;
        $this->transaction_count = $transaction_count;
    }


    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getHigherId()
    {
        return $this->higher_id;
    }

    /**
     * @return mixed
     */
    public function getLeftPoints()
    {
        return $this->left_points;
    }

    /**
     * @return mixed
     */
    public function getRightPoints()
    {
        return $this->right_points;
    }

    /**
     * @return mixed
     */
    public function getPointsPaid()
    {
        return $this->points_paid;
    }

    /**
     * @return mixed
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @return mixed
     */
    public function getTransactionCount()
    {
        return $this->transaction_count;
    }


}