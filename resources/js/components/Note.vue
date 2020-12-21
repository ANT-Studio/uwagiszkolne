<template>
    <div class="note">
        <div class="bar"/>
        <div class="content">
            <div class="description">Dodany {{ writeDate(note.created_at) }} przez {{ note.name }}:</div>
            <div class="text">{{ note.content }}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Note",
    props: ['note'],
    methods: {
        writeDate(input){
            let date = new Date(input);
            return date.toLocaleDateString();
        }
    }
}
</script>

<style lang="scss" scoped>

    .note{
        display: flex;

        .bar{
            background: gray;
            width: 5px;
            padding: 10px 0;
            margin-right: 10px;


        }

        .content{
            padding: 10px;

            .description{
                margin-bottom: 15px;
            }
        }
    }

</style>
