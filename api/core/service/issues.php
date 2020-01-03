<?php

/************************************************************************
 * Author : Akhil Suresh
 * On 23-dec-2019
 * Service for sending and saving client reports
 ************************************************************************/

class Issues extends Service implements Rest
{
    public function put()
    {
    }

    public function delete()
    {
    }
    public function get()
    {
        Parameters::required(['userID']);
        $userID = Service::getVars()['userID'];
        Db::query('SELECT * FROM `issue_reports` AS i_rep LEFT JOIN issue_communication AS i_com ON i_com.issue_id = i_rep.issue_id WHERE `user_id` = 1');
        Db::execute([
            ':user_id' => $userID
        ]);
        $result = Db::result();
        if (empty($result)) {
            Response::error('No issues found');
        }
        Response::success("Notification listed successfully", $result);
    }

    public function post()
    {
    }
}
