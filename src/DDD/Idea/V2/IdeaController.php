<?php

namespace DDD\Idea\V2;

class IdeaController extends \Zend_Controller_Action
{
    public function rateAction()
    {
        // Getting parameters from the request
        $ideaId = $this->getRequest()->getParam('id');
        $rating = $this->getRequest()->getParam('rating');
        // Building database connection
        $ideaRepository = new IdeaRepository();
        $idea = $ideaRepository->find($ideaId);
        if (!$idea) {
            throw new \Exception('Idea does not exist');
        }
        $idea->addRating($rating);
        $ideaRepository->update($idea);
        // Redirect to view idea page
        $this->redirect('/idea/' . $ideaId);
    }
}