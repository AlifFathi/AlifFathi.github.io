#ifndef PLAYER_HPP
#define PLAYER_HPP

#include "element.hpp"

class Player : public Element {
public:
    Player(int _x, int _y, int r, int hp);
    void draw();
};

#endif
