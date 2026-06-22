#ifndef LOOT_HPP
#define LOOT_HPP

#include "opponent.hpp"

class Loot : public Opponent {
public:
    Loot(int _x, int _y, int r, int hp);
    void draw();
    int winnerHp(int playerHp);
};

#endif
