# Makefile by Jakob Stark

FLAGS = -g

TARGET = main

IPATH = include/
LPATH = lib/

SRC = sumit_log.cpp
OBJ = sumit_log.o
SLIB = -l:pugixml.so -l:lodepng.so
LIB = -lsfml-window -lsfml-system -lGL

DEPENDFILE = depend

$(TARGET): $(OBJ)
	g++ -g -L$(LPATH) -o $@ $(OBJ) $(SLIB) $(LIB)

%.o: %.cpp makefile
	g++ -g -c -I$(IPATH) -o $@ $<

$(DEPENDFILE): $(SRC)
	g++ -MM -I$(IPATH) $(SRC) > $(DEPENDFILE)

-include $(DEPENDFILE)


#build shared libraries

%.so: %.cpp
	g++ -g -I$(IPATH) -shared -o $@ $<

