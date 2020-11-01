<template>
  <div>
    <button @click="addNode">Add Node</button>
    
  </div>
</template>
<script>
  import axios from 'axios';
  export default {
    components: {
      VueTreeList
    },
    data() {
      return {
        newTree: {},
        data: new Tree([
          {
            name: 'Node 1',
            id: 1,
            p_id: 0,
            children: [
              {
                name: 'Node 1-2',
                id: 2,
                isLeaf: true,
                pid: 1
              }
            ],
            files: [
              {
                id: 1,
                pid: 1
              }
            ]
          },
          {
            name: 'Node 2',
            id: 3,
            pid: 0,
            disabled: true
          },
          {
            name: 'Node 3',
            id: 4,
            pid: 0
          }
        ])
      }
    },
    mounted(){
        axios.get('/api/getFoldersAndFiles').then(res => {
            console.log(res.data);
            this.data = new Tree(res.data);
        })
    },