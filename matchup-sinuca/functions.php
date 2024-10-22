<?php 
    function SearchMatch($data, $p1, $p2) {
        $matchup = [];
        foreach($data->singleMatch as $match) {
            if($match->player_one->name == $p1 && $match->player_two->name == $p2) {
                $matchup[] = $match->result;
            }
        }

        return $matchup;
    }

    function CreateMatchup($data) {
        foreach($data->singleMatch as $match) {
            $p1 = $match->player_one->name;
            $p2 = $match->player_two->name;
            $p1Win = 0;

            $key = $p1 < $p2 ? "$p1-$p2" : "$p2-$p1";

            if (!isset($processedPairs[$key])) {
                $results = SearchMatch($data, $p1, $p2);
                $p1Win = 0;

                foreach ($results as $res) {
                    if ($res == $match->player_one->id) {
                        $p1Win++;
                    }
                }

                $p2Win = count($results) - $p1Win;
                $p1Lose = $p2Win;
                $p2Lose = $p1Win;

                $matchups[] = new Matchup(
                    $p1,
                    $p2,
                    $p1Win,
                    $p1Lose,
                    $p2Win,
                    $p2Lose
                );

                $processedPairs[$key] = true;
            }
        }

        return $matchups;
    }
?>