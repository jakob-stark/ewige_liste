/*submit_log.cpp
 *	submit_log player1 score1 player2 score2 player3 score3 player4 score4 [nr_of_games]
 */

#include <ctime>
#include <cstdio>
#include <string>
#include "pugixml.hpp"


#define EXIT_FAILURE 1

int main( int argc, char* argv[] ) {
	if (argc < 9)	//not enought arguments
		return EXIT_FAILURE;
	char * players[4];
	int scores[4];
	for( int i = 0; i < 4; i++ ) {
		players[i] = argv[2*i+1];
		if( !sscanf(argv[2*i+2],"%d", &scores[i]) )
			return EXIT_FAILURE;
	}
	int nr_og = 1;
	time_t t = time(NULL);
	if (argc > 9)	//read nr_of_games
		if( !sscanf(argv[9],"%d", &nr_og) )
			return EXIT_FAILURE;

	pugi::xml_document log_file;
	if( !log_file.load_file("log.xml") )
		return EXIT_FAILURE;

	pugi::xml_node gamelist = log_file.child("gamelist");
	pugi::xml_node round = gamelist.append_child("round");
	round.append_child("player1").append_child(pugi::node_pcdata).set_value( players[1] );
	round.append_child("player2").append_child(pugi::node_pcdata).set_value( players[2] );
	round.append_child("player3").append_child(pugi::node_pcdata).set_value( players[3] );
	round.append_child("player4").append_child(pugi::node_pcdata).set_value( players[4] );

	round.append_child("score1").append_child(pugi::node_pcdata).set_value( string(scores[1]) );
	round.append_child("score2").append_child(pugi::node_pcdata).set_value( string(scores[2]) );
	round.append_child("score3").append_child(pugi::node_pcdata).set_value( string(scores[3]) );
	round.append_child("score4").append_child(pugi::node_pcdata).set_value( string(scores[4]) );

	round.append_attribute("date") = t;
	log_file.save_file("log.xml");

	
		
		
}
