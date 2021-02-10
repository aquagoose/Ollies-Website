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

async function ParseHtmlToEditorFormat(html) {
    let json = {blocks: []};
    let splitHtml = [];

    html = html.split("<");
    console.log(html);
    for (const word of html) {
        splitHtml.push(word.split(">"));
    }

    for (const line of splitHtml) {
        if (line[0] === "h1")
            json["blocks"].push({ "type": "header", "data": { "text": line[1], "level": 1 } });
        else if (line[0] === "p")
            json["blocks"].push({ "type": "paragraph", "data": { "text": line[1] } });
        else if (line[0].startsWith("br"))
            json["blocks"][json["blocks"].length-1]["data"]["text"] += "<br>" + line[1];
        else if (line[0].startsWith("a")) {
            json["blocks"][json["blocks"].length - 1]["data"]["text"] += `<a href="${line[0].split("href=\"")[1]}">${line[1]}</a>`;
        }
    }
    console.log(json);
    return json;
}