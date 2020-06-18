constest creation by click of a button


button trigger the rounds of the game execution(6 rounds)


contestants 10
judges 3



view showing the history of the last five contest winners + final scores
The top scoring contestant of all time should also be displayed in this view

each round a genre of music
one of
Rock
Country
Pop
Disco
Jazz
The Blues


 During each round, each contestant's genre rating is
 multiplied by a random single-decimal place float between 0.1 and 10.0


interface Contestant {
     public function strength();
}


interface Genre {
    public function score();
}


5 judges only 3 is part of a contest

gives a random score out of 10, regardless of the calculated contestant score.
**RandomJudge

converts the calculated contestant score evenly using the following table
||Calculate Score Range||Judge Score||
|     0.1 - 10.0        |      1     |
|    10.1 - 20.0        |      2     |
|    20.1 - 30.0        |      3     |
|    30.1 - 40.0        |      4     |
|    40.1 - 50.0        |      5     |
|    50.1 - 60.0        |      6     |
|    60.1 - 70.0        |      7     |
|    70.1 - 80.0        |      8     |
|    80.1 - 90.0        |      9     |
|    90.1 - 100.0       |     10     |
**HonestJudge

gives every contestant with a calculated contestant score less than 90.0
a judge score of 2. Any contestant scoring 90.0 or more instead receives a 10
**MeanJudge


favourite genre is `Rock`. For any other genre, the `RockJudge` gives a random integer score out of 10,
regardless of the calculated contestant score. For the `Rock` genre,
this judge gives a score based on the calculated contestant score - less than 50.0
results in a judge score of 5, 50.0 to 74.9 results in an 8, while 75 and above results in a 10.
**RockJudge

gives every contestant a score of 8 unless they have a calculated contestant score of less than or equal to 3.0,
in which case the `FriendlyJudge` gives a 7. If the contestant is sick,
the `FriendlyJudge` awards a bonus point, regardless of calculated contestant score.
**FriendlyJudge
