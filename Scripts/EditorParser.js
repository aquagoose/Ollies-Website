async function ParseEditorToHtml(editor) {
    let html = "";
    let outputData = await editor.save();
    for (const block of outputData["blocks"]) {
        switch(block["type"]) {
            case "header":
                html += `<h1>${block["data"]["text"]}</h1>`;
                break;
            case "paragraph":
                html += `<p>${block["data"]["text"]}</p>`
                break;
        }
    }
    return html;
}