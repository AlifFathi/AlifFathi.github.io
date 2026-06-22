#ifndef GAME_HPP
#define GAME_HPP

#include "player.hpp"
#include "enemy.hpp"
#include "loot.hpp"
#include "background.hpp"

#define MAX 5

class Game {
protected:
    Player player;
    Opponent* opp[MAX];
    Background bg;

public:
    Game();
    ~Game();
    void initialize();
    void generateListOfShape();
    void gameJourney();
    void gameLoop();
    void render();
    void run();
};

#endif
