<?php include('functions.php') ?>

<?php 
    $data = file_get_contents('single-matches.json');
    $singleMatches = json_decode($data);

    class Matchup {
        public $player1;
        public $player2;
        public $p1Win;
        public $p1Lose;
        public $p2Win;
        public $p2Lose;
    
        function __construct($player1, $player2, $p1Win, $p1Lose, $p2Win, $p2Lose)
        {
            $this->player1 = $player1;
            $this->player2 = $player2;
            $this->p1Win = $p1Win;
            $this->p1Lose = $p1Lose;
            $this->p2Win = $p2Win;
            $this->p2Lose = $p2Lose;
        }
    }

    $matchups = CreateMatchup($singleMatches);
    foreach ($matchups as $matchup) {
        echo "<div>Matchup: {$matchup->player1} vs {$matchup->player2}</div>";
        echo "<div>Vitórias: {$matchup->p1Win} - Derrotas: {$matchup->p1Lose}</div>";
        echo "<div>Vitórias: {$matchup->p2Win} - Derrotas: {$matchup->p2Lose}</div>";
        echo "<br>";
    }
?>