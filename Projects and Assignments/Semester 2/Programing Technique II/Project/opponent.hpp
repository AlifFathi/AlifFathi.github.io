#ifndef OPPONENT_HPP
#define OPPONENT_HPP

#include "element.hpp"

class Opponent : public Element {
public:
    Opponent(int _x, int _y, int r, int hp);
    virtual void draw() = 0;
    virtual int winnerHp(int playerHp) = 0;
};

#endif
