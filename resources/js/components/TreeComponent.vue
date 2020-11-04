<template>
  <div>
    <button @click="addNode">Add Node</button>
    <vue-tree-list
      @click="onClick"
      @change-name="onChangeName"
      @delete-node="onDel"
      @add-node="onAddNode"
      :model="data"
      default-tree-node-name="new node"
      default-leaf-node-name="new leaf"
      v-bind:default-expanded="false"
    >
      <template v-slot:leafNameDisplay="slotProps">
        <span>
          {{ slotProps.model.name }} <span class="muted">#{{ slotProps.model.id }}</span>
        </span>
      </template>
      <span class="icon" slot="addTreeNodeIcon">📂</span>
      <span class="icon" slot="addLeafNodeIcon">＋</span>
      <span class="icon" slot="editNodeIcon">📃</span>
      <span class="icon" slot="delNodeIcon">✂️</span>
      <span class="icon" slot="leafNodeIcon">🍃</span>
      <span class="icon" slot="treeNodeIcon">🌲</span>
    </vue-tree-list>
  </div>
</template>
 
<script>
  import { VueTreeList, Tree, TreeNode } from 'vue-tree-list';
  import axios from 'axios';
  export default {
    name:'TreeComponent',
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
            pid: 0,
            children: [
              {
                name: 'Node 1-2',
                id: 2,
                isLeaf: true,
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
      this.getFoldersAndFiles();
    },
    methods: {
      getFoldersAndFiles(){
        axios.get('/api/getFoldersAndFiles').then(res => {
          this.data = new Tree(res.data);
        });
      },
      onDel(node) {
        var isLeaf = node.isLeaf ? true : false;
        axios.post('/api/deleteFolderAndFile/'+ node.id,{isLeaf:isLeaf}).then(res => {
            node.remove();
        });
      },
 
      onChangeName(params) {
        var isLeaf = params.isLeaf ? true : false;
        var requestData = {name:params.newName,isLeaf:isLeaf}
        if(params.eventType == 'blur')
        {
          axios.put('/api/updateFolderAndFile/'+ params.id,requestData).then(res => {

          });
        }
      }, 
      onAddNode(params) {
        var requestData = {name: params.name,pid:params.pid,isLeaf:params.isLeaf}
        axios.post('/api/addFolderAndFile',requestData).then(res => {
            params.id = res.data.id;
        });
      }, 
      onClick(params) {
        console.log(params)
      }, 
      addNode() {
        var node = new TreeNode({ name: 'new node', isLeaf: false })
        if (!this.data.children) this.data.children = []
        this.data.addChildren(node)
        axios.post('/api/addFolderAndFile',{ name: 'new node', isLeaf: false }).then(res => {
          params.id = res.data.id;
        });
      }
    }
  }
</script> 
 
<style>
  .vtl {
    .vtl-drag-disabled {
      background-color: #d0cfcf;
      &:hover {
        background-color: #d0cfcf;
      }
    }
    .vtl-disabled {
      background-color: #d0cfcf;
    }
  }
</style> 
 
<style scoped>
  .icon {
    &:hover {
      cursor: pointer;
    }
  }
 
  .muted {
    color: gray;
    font-size: 80%;
  }
</style>
