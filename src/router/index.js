import { createRouter, createWebHistory } from 'vue-router';
import IndexView from '../views/Index.vue';
import MatchIndex from '../views/Match/Index.vue';
import JoueurIndex from '../views/Joueur/Index.vue';
import JoueurEdit from '../views/Joueur/Edit.vue';
import EquipeIndex from '../views/Equipe/Index.vue';
import JoueurItem from '../views/Joueur/Show.vue';
import JoueurDelete from '../views/Joueur/Delete.vue';
import JoueurCreate from '../views/Joueur/Create.vue';




const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'accueil',
            component: IndexView
        },
        {
            path: '/matchs',
            name: 'matchs.index',
            component: MatchIndex,
        },
        
        
        {
            path: '/joueurs',
            name: 'joueurs.index',
            component: JoueurIndex,
        },
        {
            path: '/joueurs/:id',
            name: 'joueurs.show',
            component: JoueurItem,
            props:true,
        },
        {
            path: '/joueurs/:id/edit',
            name: 'joueurs.edit',
            component: JoueurEdit,
            props:true,
        },
        {
            path: '/joueurs/:id/delete',
            name: 'joueurs.delete',
            component: JoueurDelete,
            props:true,
        },


        {
            path: '/equipes',
            name: 'equipes.index',
            component: EquipeIndex,
        },
        
        {
            path: '/joueurs/create',
            name: 'joueurs.create',
            component: JoueurCreate,
          },
        
        
    ]
});

export default router;
