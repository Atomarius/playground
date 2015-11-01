<?php

namespace DDD\Idea\V4;

class IdeaController extends \Zend_Controller_Action
{
    public function rateAction()
    {
        // Getting parameters from the request
        $ideaId = $this->getRequest()->getParam('id');
        $rating = $this->getRequest()->getParam('rating');
        // Building database connection
        $ideaRepository = new RedisIdeaRepository();
        $rateIdeaCommand = new RateIdeaCommand($ideaRepository);
        $rateIdeaCommand->execute($ideaId, $rating);
        // Redirect to view idea page
        $this->redirect('/idea/' . $ideaId);
    }
}