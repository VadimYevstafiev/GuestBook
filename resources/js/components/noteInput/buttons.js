class Tag{
    constructor() {
        this.textareaID = 'content';
    }

    insert(text) {
        return '';
    }

    wrap() {
        const textarea = document.getElementById(this.textareaID);
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        if (start !== end) {
            const text = textarea.value;
            textarea.value = text.substring(0, start) + this.insert(text.substring(start, end)) + text.substring(end);
        }
        textarea.focus();
    }
}

class simpleTag extends Tag{
    constructor(tag) {
        super();
        this.tag = tag;
    }

    insert(text) {
        return `<${this.tag}>${text}</${this.tag}>`;
    }
}

class linklTag extends Tag{
    insert(text) {
        return `<a href=”${text}” title=”${text}”>'${text}'</a>`;
    }
}

if (document.querySelector('#mote-input') !== null) {
    const italicButton = document.getElementById('italic');
    italicButton.addEventListener('click', function () {
        (new simpleTag ('i')).wrap();
    });

    const strongButton = document.getElementById('strong');
    strongButton.addEventListener('click', function () {
        (new simpleTag ('strong')).wrap();
    });

    const codeButton = document.getElementById('code');
    codeButton.addEventListener('click', function () {
        (new simpleTag ('code')).wrap();
    }); 

    const linkButton = document.getElementById('link');
    linkButton.addEventListener('click', function () {
        (new linklTag ()).wrap();
    });
}
