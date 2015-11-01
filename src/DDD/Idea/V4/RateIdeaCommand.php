<?php

namespace DDD\Idea\V4;

class RateIdeaCommand
{
    private $ideaRepository;

    public function __construct(IdeaRepository $ideaRepository)
    {
        $this->ideaRepository = $ideaRepository;
    }

    public function execute($ideaId, $rating)
    {
        try {
            $idea = $this->ideaRepository->find($ideaId);
        } catch (\Exception $e) {
            throw new RepositoryNotAvailableException();
        }
        if (!$idea) {
            throw new IdeaDoesNotExistException();
        }
        try {
            $idea->addRating($rating);
            $this->ideaRepository->update($idea);
        } catch (\Exception $e) {
            throw new RepositoryNotAvailableException();
        }

        return $idea;
    }
}