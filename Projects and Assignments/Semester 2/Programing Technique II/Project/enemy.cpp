#include <graphics.h>
#include "enemy.hpp"

Enemy::Enemy(int _x, int _y, int r, int hp) : Opponent(_x,_y,r,hp) {}

void Enemy::draw() {
    setcolor(RED);
    setfillstyle(SOLID_FILL, RED);
    fillellipse(x, y, radius / 2, radius / 2);

    setcolor(BLACK);
    setbkcolor(RED);
    char str[10];
    sprintf(str, "%d", health);

    int textWidth = textwidth(str);
    int textHeight = textheight(str);

    outtextxy(x - textWidth / 2, y - textHeight / 2, str);
    setbkcolor(WHITE);
}

int Enemy::winnerHp(int playerHp) {
    if (playerHp > health) {
        playerHp += health;
    } else {
        playerHp -= health;
    }
    return playerHp;
}
