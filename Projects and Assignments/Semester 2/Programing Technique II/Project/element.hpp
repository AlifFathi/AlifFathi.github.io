#ifndef ELEMENT_HPP
#define ELEMENT_HPP

class Element 
{
protected:
    int x, y, radius, health;

public:
    Element(int _x, int _y, int r, int hp);
    void setHealth(int);
    int getHealth();
    void setX(int);
    int getX();
    void setY(int);
    int getY();
    void setRadius(int);
    int getRadius();
};

#endif
