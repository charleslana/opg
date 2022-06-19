create table `character`
(
    id                             int unsigned auto_increment
        primary key,
    name                           varchar(255)       not null,
    image                          varchar(255)       not null,
    strength_attributes            int                not null,
    defense_attributes             int                not null,
    life_attributes                int                not null,
    energy_attributes              int                not null,
    agility_attributes             int                not null,
    resistance_attributes          int                not null,
    maximum_level                  int                not null,
    haki_unlock                    enum ('no', 'yes') not null,
    akuma_no_mi_unlock             enum ('no', 'yes') not null,
    player_level_unlock            int                null,
    character_level_unlock         int                null,
    character_npc_battles_unlock   int                null,
    character_arena_battles_unlock int                null,
    character_npc_wins_unlock      int                null,
    character_arena_wins_unlock    int                null,
    constraint character_name_uindex
        unique (name)
);

