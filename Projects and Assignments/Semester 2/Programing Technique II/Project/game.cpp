#include "game.hpp"
#include <graphics.h>
#include <cstdlib>
#include <ctime>

Game::Game() : player(100, 200, 50, 5) {
    srand(time(0));
    generateListOfShape();
}

Game::~Game() {
    for (int i = 0; i < MAX; ++i) {
        delete opp[i];
    }
}

void Game::initialize() {
    int width = getmaxwidth();
    int height = getmaxheight();
    initwindow(width, height, "MATH BATTLE");
    bg.displayBackground("bg.jpg");
}

void Game::generateListOfShape() {
    int x = 800 + rand() % 500;
    int y = 100;
    int radius = 70;
    int health = 10 + rand() % 10;
    opp[0] = new Loot(x, y, radius, health);
    y += 150;
    for (int i = 1; i < MAX; i++) {
        int side = rand() % 2;
        if (side == 0) {
            health = 5 + rand() % 10;
            opp[i] = new Enemy(x, y, radius, health);
        } else {
            health = 10 + rand() % 10;
            opp[i] = new Loot(x, y, radius, health);
        }
        x = 800 + rand() % 500;
        y += 150;
        
    }
}

void Game::gameJourney() {
    if (GetAsyncKeyState(VK_LBUTTON)) {
        int x = mousex();
        int y = mousey();

        for (int i = 0; i < MAX; i++) {
            if (opp[i] != nullptr) {
                int dx = x - opp[i]->getX();
                int dy = y - opp[i]->getY();
                if (dx * dx + dy * dy <= opp[i]->getRadius() * opp[i]->getRadius()) {
                    player.setHealth(opp[i]->winnerHp(player.getHealth()));
                    player.setRadius(player.getRadius() + 10);

                    if (player.getHealth() <= 0) {
                        bg.displayGameOver("lose.jpg");
                        getch();
                        closegraph();
                        exit(0);
                    } 
                    else {
                        delete opp[i];
                        opp[i] = nullptr;
                        break;
                    }
                }
            }
        }
    }
}

void Game::gameLoop() {
    while (true) {
       
        gameJourney();

        bg.displayBackground("bg.jpg");
        render();

        if (player.getHealth() <= 0) {
            bg.displayGameOver("lose.jpg");
            break;
        } else {
            bool allNull = true;
            for (int i = 0; i < MAX; i++) {
                if (opp[i] != nullptr) {
                    allNull = false;
                    break;
                }
            }
            if (allNull) {
                bg.displayYouWin("win.jpg");
                break;
            }
        }

        delay(100);
    }
}

void Game::render() {
    player.draw();
    for (int i = 0; i < MAX; i++) {
        if (opp[i] != nullptr) {
            opp[i]->draw();
        }
    }
}

void Game::run() {
    initialize();
    gameLoop();
    getch();
    closegraph();
}
