window.livewire.on('editing', commentId => {
    const parentElement = document.querySelector(`[data-comment-edit-id="${commentId}"]`);
    // Create an edit box using JavaScript
    const editBox = document.createElement('input');
    editBox.type = 'text';
    console.log('editing');
    editBox.value = parentElement.innerHTML;
    editBox.setAttribute('id', `comment-edit-box-${commentId}`);

    // Clear the existing content of the parent element
    parentElement.innerHTML = "";
    parentElement.appendChild(editBox);
});

window.livewire.on('saved', commentId => {
    const parentElement = document.querySelector(`[data-comment-edit-id="comment-edit-${commentId}"]`);

    const editBox = document.querySelector(`comment-edit-box-${commentId}`);
    const content = editBox.value;
    parentElement.removeChild(editBox);
    parentElement.innerHTML = content;

    
    window.livewire.emit('editComment', ({content}));
});
