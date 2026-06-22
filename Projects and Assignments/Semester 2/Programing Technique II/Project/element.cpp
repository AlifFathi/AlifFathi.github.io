#include "element.hpp"

Element::Element(int _x, int _y, int r, int hp) : x(_x), y(_y), radius(r), health(hp) {}

void Element::setHealth(int hp) {
    health = hp;
}

int Element::getHealth() {
    return health;
}
void Element::setX(int _x) { x = _x; }
int Element::getX() { return x; }
void Element::setY(int _y) { y = _y; }
int Element::getY() { return y; }
void Element::setRadius(int r) { radius = r; }
int Element::getRadius() { return radius; }
