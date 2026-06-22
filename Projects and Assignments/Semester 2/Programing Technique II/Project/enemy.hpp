#ifndef ENEMY_HPP
#define ENEMY_HPP

#include "opponent.hpp"

class Enemy : public Opponent {
public:
    Enemy(int _x, int _y, int r, int hp);
    void draw();
    int winnerHp(int playerHp);
};

#endif
