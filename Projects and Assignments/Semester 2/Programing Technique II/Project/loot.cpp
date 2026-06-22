#include <graphics.h>
#include "loot.hpp"

Loot::Loot(int _x, int _y, int r, int hp) : Opponent(_x,_y,r,hp) {}

void Loot::draw() {
    setcolor(GREEN);
    setfillstyle(SOLID_FILL, GREEN);
    fillellipse(x, y, radius / 2, radius / 2);

    setcolor(BLACK);
    setbkcolor(GREEN);
    char str[10];
    sprintf(str, "%d", health);

    int textWidth = textwidth(str);
    int textHeight = textheight(str);

    outtextxy(x - textWidth / 2, y - textHeight / 2, str);
    setbkcolor(WHITE);
}

int Loot::winnerHp(int playerHp) {
    return playerHp += health;
}
