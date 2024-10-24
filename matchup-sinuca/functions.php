<?php 
    function SearchMatchSolo($data, $p1, $p2) {
        $matchup = [];
        foreach($data->singleMatch as $match) {
            if($match->player_one->name == $p1 && $match->player_two->name == $p2) {
                $matchup[] = $match->result;
            }
        }

        return $matchup;
    }

    function CreateMatchupSolo($data) {
        foreach($data->singleMatch as $match) {
            $p1 = $match->player_one->name;
            $p2 = $match->player_two->name;
            $p1Win = 0;

            $key = $p1 < $p2 ? "$p1-$p2" : "$p2-$p1";

            if (!isset($processedPairs[$key])) {
                $results = SearchMatchSolo($data, $p1, $p2);
                $p1Win = 0;

                foreach ($results as $res) {
                    if ($res == $match->player_one->id) {
                        $p1Win++;
                    }
                }

                $p2Win = count($results) - $p1Win;
                $p1Lose = $p2Win;
                $p2Lose = $p1Win;

                $matchups[] = new MatchupSolo(
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

    function SearchMatchDuo($data, $duo_one_id, $duo_two_id) {
        $matchup = [];
        
        foreach ($data->duoMatch as $match) {
            // Verifica se a combinação dos IDs das duplas é encontrada
            if (($match->duo_one_id == $duo_one_id && $match->duo_two_id == $duo_two_id) || 
                ($match->duo_one_id == $duo_two_id && $match->duo_two_id == $duo_one_id)) {
                $matchup[] = $match->result;
            }
        }
        
        return $matchup;
    }
    

    function CreateMatchupDuo($data) {
        $matchups = [];
        $processedPairs = [];
    
        foreach ($data->duoMatch as $match) {
            // IDs das duplas
            $duo_one_id = $match->duo_one_id;
            $duo_two_id = $match->duo_two_id;
    
            // Cria uma chave única para identificar o matchup
            $key = "$duo_one_id-$duo_two_id";
    
            // Verifica se o par já foi processado
            if (!isset($processedPairs[$key])) {
                // Busca os resultados das partidas entre as duplas
                $results = SearchMatchDuo($data, $duo_one_id, $duo_two_id);
    
                // Contagem de vitórias para cada dupla
                $duo1Wins = 0;
                foreach ($results as $result) {
                    if ($result == $duo_one_id) {
                        $duo1Wins++;
                    }
                }
    
                // Calcula vitórias e derrotas
                $totalMatches = count($results);
                $duo1Lose = $totalMatches - $duo1Wins;
                $duo2Wins = $duo1Lose;
                $duo2Lose = $duo1Wins;
    
                // Obtém os nomes dos jogadores para exibir no matchup
                $duo1Names = $match->duo_player->player_one->name . "-" . $match->duo_player->player_two->name;
                $duo2Names = $match->duo_player_two->player_one->name . "-" . $match->duo_player_two->player_two->name;
    
                // Adiciona o matchup ao array
                $matchups[] = new MatchupDuo(
                    $duo1Names,
                    $duo2Names,
                    $duo1Wins,
                    $duo1Lose,
                    $duo2Wins,
                    $duo2Lose
                );
    
                // Marca o par como processado
                $processedPairs[$key] = true;
            }
        }
    
        return $matchups;
    }
    
    
    
    
    
    
?>