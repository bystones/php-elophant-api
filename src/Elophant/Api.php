<?php

namespace Elophant;

use Elophant\Adapter\AdapterInterface;

class Api {

    /**
     * The API key
     * @var string 
     */
    protected $apiKey = null;
    
    /**
     * THE Adapter to get the resources
     * @var \Elophant\Adapter\AdapterInterface 
     */
    protected $adapter = null;

    /**
     * 
     * @param \Elophant\Adapter\AdapterInterface $adapter
     * @param string $apiKey
     * @throws \InvalidArgumentException
     */
    public function __construct(AdapterInterface $adapter, $apiKey) {
        if (!is_string($apiKey)) {
            throw new \InvalidArgumentException('API-Key must be a string.');
        }

        $this->apiKey = $apiKey;
        $this->adapter = $adapter;
    }

    /**
     * Returns the API key
     * @return string
     */
    public function getApiKey() {
        return $this->apiKey;
    }

    /**
     * Sets the API key
     * @param string $apiKey
     * @throws \InvalidArgumentException
     */
    public function setApiKey($apiKey) {
        if (!is_string($apiKey)) {
            throw new \InvalidArgumentException('API-Key must be a string.');
        }

        $this->apiKey = $apiKey;
    }

    /**
     * Returns the adapter
     * @return \Elophant\Adapter\AdapterInterface 
     */
    public function getAdapter() {
        return $this->adapter;
    }

    /**
     * Sets the adapter
     * @param \Elophant\Adapter\AdapterInterface $adapter
     */
    public function setAdapter(AdapterInterface $adapter) {
        $this->adapter = $adapter;
    }

    /**
     * @link http://elophant.com/developers/docs/items
     * @return \Elophant\Response
     */
    public function getItems() {
        return $this->adapter->getResource($this->getApiKey(), 'items');
    }

    /**
     * @link http://elophant.com/developers/docs/champions
     * @return \Elophant\Response
     */
    public function getChampions() {
        return $this->adapter->getResource($this->getApiKey(), 'champions');
    }

    /**
     * @link http://elophant.com/developers/docs/summoner
     * @param string $region
     * @param string $summonerName
     * @return \Elophant\Response
     * @throws \InvalidArgumentException
     */
    public function getSummoner($region, $summonerName) {
        if (!is_string($summonerName)) {
            throw new \InvalidArgumentException('Summoner name must be a string');
        }

        return $this->adapter->getResource($this->getApiKey(), 'summoner', array(
                    $summonerName
                        ), $region);
    }

    /**
     * @link http://elophant.com/developers/docs/mastery_pages
     * @param string $region
     * @param integer $summonerId
     * @return \Elophant\Response
     * @throws \InvalidArgumentException
     */
    public function getMasteryPages($region, $summonerId) {
        if (!is_int($summonerId)) {
            throw new \InvalidArgumentException('Summoner id must ba an integer');
        }

        return $this->adapter->getResource($this->getApiKey(), 'mastery_pages', array(
                    $summonerId
                        ), $region);
    }

    /**
     * @link http://elophant.com/developers/docs/rune_pages
     * @param string $region
     * @param integer $summonerId
     * @return \Elophant\Response
     * @throws \InvalidArgumentException
     */
    public function getRunePages($region, $summonerId) {
        if (!is_int($summonerId)) {
            throw new \InvalidArgumentException('Summoner id must ba an integer');
        }

        return $this->adapter->getResource($this->getApiKey(), 'rune_pages', array(
                    $summonerId
                        ), $region);
    }

    /**
     * @link http://elophant.com/developers/docs/recent_games
     * @param string $region
     * @param integer $accountId
     * @return \Elophant\Response
     * @throws \InvalidArgumentException
     */
    public function getRecentGames($region, $accountId) {
        if (!is_int($accountId)) {
            throw new \InvalidArgumentException('Account id must ba an integer');
        }

        return $this->adapter->getResource($this->getApiKey(), 'recent_games', array(
                    $accountId
                        ), $region);
    }

    /**
     * @link http://elophant.com/developers/docs/summoner_names
     * @param string $region
     * @param array $summonerIds
     * @return \Elophant\Response
     */
    public function getSummonerNames($region, array $summonerIds) {
        return $this->adapter->getResource($this->getApiKey(), 'summoner_names', array(
                    implode(',', $summonerIds)
                        ), $region);
    }

    /**
     * @link http://elophant.com/developers/docs/leagues
     * @param string $region
     * @param integer $summonerId
     * @return \Elophant\Response
     * @throws \InvalidArgumentException
     */
    public function getLeagues($region, $summonerId) {
        if (!is_int($summonerId)) {
            throw new \InvalidArgumentException('Summoner id must ba an integer');
        }

        return $this->adapter->getResource($this->getApiKey(), 'leagues', array(
                    $summonerId
                        ), $region);
    }

    /**
     * @link http://elophant.com/developers/docs/ranked_stats
     * @param string $region
     * @param integer $accountId
     * @param string $season
     * @return \Elophant\Response
     * @throws \InvalidArgumentException
     */
    public function getRankedStats($region, $accountId, $season) {
        if (!is_int($accountId)) {
            throw new \InvalidArgumentException('Account id must ba an integer');
        }

        if (!is_string($season)) {
            throw new \InvalidArgumentException('Season must ba a string');
        }

        return $this->adapter->getResource($this->getApiKey(), 'ranked_stats', array(
                    $accountId,
                    $season
                        ), $region);
    }

    /**
     * @link http://elophant.com/developers/docs/summoner_team_info
     * @param string $region
     * @param integer $summonerId
     * @return \Elophant\Response
     * @throws \InvalidArgumentException
     */
    public function getSummonerTeamInfo($region, $summonerId) {
        if (!is_int($summonerId)) {
            throw new \InvalidArgumentException('Summoner id must ba an integer');
        }

        return $this->adapter->getResource($this->getApiKey(), 'summoner_team_info', array(
                    $summonerId
                        ), $region);
    }

    /**
     * @link http://elophant.com/developers/docs/in_progress_game_info
     * @param string $region
     * @param string $summonerName
     * @return \Elophant\Response
     * @throws \InvalidArgumentException
     */
    public function getInProgressGameInfo($region, $summonerName) {
        if (!is_string($summonerName)) {
            throw new \InvalidArgumentException('Summoner name must be a string');
        }

        return $this->adapter->getResource($this->getApiKey(), 'in_progress_game_info', array(
                    $summonerName
                        ), $region);
    }

    /**
     * @link http://elophant.com/developers/docs/team
     * @param string $region
     * @param string $teamId
     * @return \Elophant\Response
     * @throws \InvalidArgumentException
     */
    public function getTeam($region, $teamId) {
        if (!is_string($teamId)) {
            throw new \InvalidArgumentException('Team id must be a string');
        }

        return $this->adapter->getResource($this->getApiKey(), 'team', array(
                    $teamId
                        ), $region);
    }

    /**
     * @link http://elophant.com/developers/docs/find_team
     * @param string $region
     * @param string $tagOrName
     * @return \Elophant\Response
     */
    public function findTeam($region, $tagOrName) {
        return $this->getFindTeam($region, $tagOrName);
    }

    /**
     * @link http://elophant.com/developers/docs/find_team
     * @param string $region
     * @param string $tagOrName
     * @return \Elophant\Response
     * @throws \InvalidArgumentException
     */
    public function getFindTeam($region, $tagOrName) {
        if (!is_string($tagOrName)) {
            throw new \InvalidArgumentException('Tag or Name must be a string');
        }

        return $this->adapter->getResource($this->getApiKey(), 'find_team', array(
                    $tagOrName
                        ), $region);
    }

    /**
     * @link http://elophant.com/developers/docs/team_end_of_game_stats
     * @param string $region
     * @param string $teamId
     * @param double $gameId
     * @return \Elophant\Response
     * @throws \InvalidArgumentException
     */
    public function getTeamEndOfGameStats($region, $teamId, $gameId) {
        if (!is_string($teamId)) {
            throw new \InvalidArgumentException('Team id must be a string');
        }

        return $this->adapter->getResource($this->getApiKey(), 'team_end_of_game_stats', array(
                    $teamId,
                    $gameId
                        ), $region);
    }

    /**
     * @link http://elophant.com/developers/docs/team_ranked_stats
     * @param string $region
     * @param string $teamId
     * @return \Elophant\Response
     * @throws \InvalidArgumentException
     */
    public function getTeamRankedStats($region, $teamId) {
        if (!is_string($teamId)) {
            throw new \InvalidArgumentException('Team id must be a string');
        }

        return $this->adapter->getResource($this->getApiKey(), 'team_ranked_stats', array(
                    $teamId
                        ), $region);
    }

}
