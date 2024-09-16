# rube-goldberg-hello-world
A hello world with the rube goldberg machine philosophy

Architecture:
```mermaid
flowchart LR
    id1-->id2
    id2-->id3
    id3-->id2
    subgraph React
        style React fill:#51afe6,stroke:#51afe6,stroke-width:2px, rx: 2,ry:2
        direction LR
        id1(Click Step Button)
        style id1 fill:#4079ab,stroke:#61DAFB,stroke-width:1px,color:#51afe6
    end
    subgraph PHP
        style PHP fill:#4F5B93,stroke:#4F5B93,stroke-width:2px, rx: 2,ry:2
        direction TB
        id2(Route: /steps/next)
        style id2 fill:#394375,stroke:#7A86B8,stroke-width:1px,color:#7A86B8
    end
    subgraph MySQL
        style MySQL fill:#2b5d80,stroke:#2b5d80,stroke-width:2px, rx: 2,ry:2
        direction TB
        id3(UPDATE steps)
        style id3 fill:#183e59,stroke:#427599,stroke-width:1px,color:#427599
    end

```
