#include <stdio.h>
#include <stdlib.h>

#define COMMAND_LEN 8
#define DATA_SIZE 512

int main()
{
    FILE *filePointer;

    filePointer = fopen("hello-world.csv", "w+");
    fprintf(filePointer, "h,e,l,l,o, ,w,o,r,l,d\n");
    fclose(filePointer);

    FILE *FileOpen;

    char line[130];

    FileOpen = popen("node hello.js", "r");

    while (fgets(line, sizeof line, FileOpen))
    {
        printf("%s", line);
    }
    printf("\n");

    pclose(FileOpen);
    system("rm -f hello-world.csv");
}