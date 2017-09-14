#include <Arduino.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>
#include <ArduinoJson.h>

#define USE_SERIAL Serial

ESP8266WiFiMulti WiFiMulti;

int led_Pin[] = {5, 4, 0, 14, 12, 13};

void setup() {

    USE_SERIAL.begin(115200);
   // USE_SERIAL.setDebugOutput(true);

    USE_SERIAL.println();
    USE_SERIAL.println();
    USE_SERIAL.println();

    for(uint8_t t = 4; t > 0; t--) {
        USE_SERIAL.printf("[SETUP] WAIT %d...\n", t);
        USE_SERIAL.flush();
        delay(1000);
    }

    for(int k=0;k<6;k++) {
        pinMode(led_Pin[k], OUTPUT);
    }

    do {
      WiFi.begin("Icys", "silented");
    } while(WiFi.status() != WL_CONNECTED);
}

void loop() {
    // wait for WiFi connection
    if((WiFi.status() == WL_CONNECTED)) {

        HTTPClient http;

        USE_SERIAL.print("[HTTP] begin...\n");
        // configure traged server and url

        String url = "http://27.254.170.164/lightcontrol/data.php";
        
        http.begin(url);
        http.setAuthorization("Icys", "silented");
  
        USE_SERIAL.print("[HTTP] GET...\n");
        // start connection and send HTTP header
        int httpCode = http.GET();
  
        // httpCode will be negative on error
        if(httpCode > 0) {
            // HTTP header has been send and Server response header has been handled
            USE_SERIAL.printf("[HTTP] GET... code: %d\n", httpCode);
  
            // file found at server
            if(httpCode == HTTP_CODE_OK) {
                String input = http.getString();
                String convent = input;
                //convent.substring(2,(convent.length()-1));
                convent.replace("[", "");
                convent.replace("]", "");
                  
                Serial.println(convent);
                  
                for(int i=1;i<=6;i++) {
                  DynamicJsonBuffer jsonBuffer;
                  JsonObject& root = jsonBuffer.parseObject(convent);
                  
                  String room_name = root[String(i)][String("name")];
                  int state = root[String(i)][String("state")];

                  if(state == 1) digitalWrite(led_Pin[i-1], LOW);
                  else digitalWrite(led_Pin[i-1], HIGH);
                    
                  USE_SERIAL.println("-----------------");
                  USE_SERIAL.println(String(i));
                  USE_SERIAL.println(String(room_name));
                  USE_SERIAL.println(String(state));
                  USE_SERIAL.println(digitalRead(led_Pin[i-1]));
                  USE_SERIAL.println("=================");
                }
            }
        } else {
            USE_SERIAL.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
        }
  
        http.end();
    }
    delay(500);
}


