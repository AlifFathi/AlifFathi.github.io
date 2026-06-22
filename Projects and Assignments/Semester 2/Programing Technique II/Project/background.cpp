#include <graphics.h>
#include "background.hpp"

void Background::displayGameOver(const char* imagePath) {
    readimagefile(imagePath, 0, 0, getmaxx(), getmaxy());
}

void Background::displayYouWin(const char* imagePath) {
    readimagefile(imagePath, 0, 0, getmaxx(), getmaxy());
}

void Background::displayBackground(const char* imagePath) {
    readimagefile(imagePath, 0, 0, getmaxx(), getmaxy());
}
